import axios from "axios";
import { mapGetters } from "vuex";
export default {
    name: "HomePage",
    data() {
        return {
            postLists: {},
            categoryLists: {},
            searchKey: "",
            tokenStatus: false,
        };
    },
    computed: {
        ...mapGetters(["storeToken","storeUserData"]),
    },
    methods: {
        getAllPost() {
            axios.get("http://127.0.0.1:8000/api/allPostList").then((response) => {

                for (let i = 0; i < response.data.post.length; i++) {
                    if (response.data.post[i].image != null) {
                        response.data.post[i].image = "http://localhost:8000/postImage/" + response.data.post[i].image;
                    } else {
                        response.data.post[i].image = "http://localhost:8000/defaultImage/default.jpg";
                    }
                }
                // console.log(response.data.post);
                this.postLists = response.data.post;
            });
        },
        loadCategory() {
            axios.get("http://127.0.0.1:8000/api/allCategory").then((response) => {
                this.categoryLists = response.data.category;
            });
        },
        search() {
            let search = {
                key: this.searchKey,
            }
            //    console.log("data is searching...");
            axios.post("http://127.0.0.1:8000/api/post/search", search).then((response) => {
                // console.log(response.data.searchData);
                for (let i = 0; i < response.data.searchData.length; i++) {
                    if (response.data.searchData[i].image != null) {
                        response.data.searchData[i].image = "http://localhost:8000/postImage/" +
                            response.data.searchData[i].image;
                    } else {
                        response.data.searchData[i].image = "http://localhost:8000/defaultImage/default.jpg";
                    }
                }

                this.postLists = response.data.searchData;
            });
        },
        newsDetails(id){
            this.$router.push({
                name: "newsDetails",
                query: {
                    newsId: id,
                },
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
        categorySearch(searchKey) {
            let search = {
                key: searchKey
            };
            axios.post("http://127.0.0.1:8000/api/category/search", search).then((response) => {
                for (let i = 0; i < response.data.result.length; i++) {
                    if (response.data.result[i].image != null) {
                        response.data.result[i].image = "http://localhost:8000/postImage/" +
                            response.data.result[i].image;
                    } else {
                        response.data.result[i].image = "http://localhost:8000/defaultImage/default.jpg";
                    }
                }

                this.postLists = response.data.result;
            }).catch((error) => console.log(error));

        },
        logout(){
            this.$store.dispatch("setToken", null);
            this.login();
        },
        checkToken(){
            if(this.storeToken != null &&
               this.storeToken != undefined &&
                this.storeToken !=""
             ){
                this.tokenStatus = true;
            }else{
                this.tokenStatus = false;
            }
        },
    },
    mounted() {
        // console.log(this.storeToken);
        this.checkToken();
        this.getAllPost();
        this.loadCategory();
    }
}


