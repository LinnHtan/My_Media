import axios from "axios";
import { mapGetters } from "vuex";
export default {
    name: "NewsDetails",
    data () {
        return {
            postId: 0,
            posts:{},
            viewCount: 0
        };
    },
    computed: {
        ...mapGetters(["storeToken","storeUserData"]),
    },
    methods: {
        loadPost (id) {
                let post = {
                    postId: id,
                }
                //    console.log("data is searching...");
                axios.post("http://127.0.0.1:8000/api/post/details", post).then((response) => {
                    
                        // if(response.data.post){ //added
                            if (response.data.post.image != null) {
                                response.data.post.image = "http://localhost:8000/postImage/" +
                                    response.data.post.image;
                            } else {
                                response.data.post.image = "http://localhost:8000/defaultImage/default.jpg";
                            }
                        this.posts = response.data.post;
                        // }
                });   
        },

        home(){
            this.$router.push({
                name: "homePage",
            })
        },

        login(){
            this.$router.push({
                name: "login",
            })
        },
        back(){
            history.back();
        },
        viewCountLoad(){

            let data = {
                user_id: this.storeUserData.id,
                new_id: this.$route.query.newsId,
            };
           
            axios.post("http://127.0.0.1:8000/api/post/actionLog", data).then((response)=> {
                this.viewCount = response.data.post.length;
            });
        }
    },
    mounted(){
        // console.log(this.storeUserData);
        this.viewCountLoad();
        this.postId = this.$route.query.newsId;
        this.loadPost(this.postId);
    },
};
