function importPage(pageName) {
    return () => import(`../pages/${pageName}.vue`).then((m) => m.default || m);
}

export default [
    {
        path: "/",
        name: "Index",
        component: importPage("Index"),
        meta: {
            title: "Personal Finance",
            middleware: "guest",
        },
    },
    {
        path: "/register",
        name: "Register",
        component: importPage("Register"),
        meta: {
            title: "Register - Personal Finance",
            middleware: "guest",
        },
    },
    {
        path: "/login",
        name: "Login",
        component: importPage("Login"),
        meta: {
            title: "Login - Personal Finance",
            middleware: "guest",
        },
    },
    {
        path: "/auth/dashboard",
        name: "Dashboard",
        component: importPage("Dashboard"),
        meta: {
            title: "Dashboard - Personal Finance",
            middleware: "auth",
        },
    },
];
