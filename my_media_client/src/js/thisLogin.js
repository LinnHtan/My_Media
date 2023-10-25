import axios from "axios";
import { mapGetters } from "vuex";
export default {
    name: "login",
    data () {
        return {
            userData: {
                email: "",
                password: "",
            },
            tokenStatus: false,
            userStatus:false,
        };
    },
    computed:{
        ...mapGetters(["storeToken","storeUserData"]),
    },
    methods: {

        login(){
            this.$router.push({
                name: "login",
            })
        },
        logout(){
            this.$store.dispatch("setToken", null);
            this.login();
        },

        home(){
            this.$router.push({
                name: "homePage",
            })
        },
        accountLogin(){
            axios.post("http://127.0.0.1:8000/api/user/login", this.userData).then((response)=>{
                if(response.data.token == null) {
                   this.userStatus = true;
                }else{
                  this.userStatus = false;
                //   this.userData = {};
                  this.storeInfo(response);
                  this.home();
                }
            });
        },
        storeInfo(response){
            this.$store.dispatch("setToken", response.data.token);
            this.$store.dispatch("setUserData", response.data.user);
           
        },
    },


};
