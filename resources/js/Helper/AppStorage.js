class AppStorage{

    //This class saves the generated token to the client's local storage
    storeToken(token){
        localStorage.setItem('token', token);
    }

    storeUser(){
        localStorage.setItem('user', user);
    }

    store(token, user){
        this.storeToken(token);
        this.storeUser(user);
    }

    clear(){
        localStorage.removeItem('token');
        localStorage.removeItem('user')
    }

    getToken(){
        localStorage.getItem(token);
    }

    getUser(){
        localStorage.getItem(user);
    }

}export default AppStorage = new AppStorage();
