import { defineStore } from "pinia";

export const useAuthStore = defineStore("authProvider", {
    state: () => {
        return { authenticated: false, user: {} };
    },
    getters: {
        isAuthenticated: (state) => {
            return state.authenticated;
        },
    },
    actions: {
        async getUser() {
            await axios
                .get("/api/v1/user")
                .then((data) => {
                    this.authenticated = true;
                    console.log(data);
                })
                .then((error) => {
                    console.log(error);
                });
        },
    },
});
