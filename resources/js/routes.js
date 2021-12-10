import Home from './components/Home'
import Register from './components/Auth/Register'
import Login from "./components/Auth/Login";
import ApiCalling from "./components/ApiCalling";

var check_authenticate = (to, form, next) => {
    window.axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('token')
    axios.get('/api/authenticated').then(()=>{
        next()
    }).catch(()=>{
        return next({name : 'login'})
    })
}

const routes = [
    {
        path: '/',
        component: Home,
        name: 'home',
        beforeEnter : check_authenticate,
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
    },
    {
        path: '/api-calling',
        component: ApiCalling,
        name: 'api_calling',
        beforeEnter: check_authenticate
    },
];


export default routes;
