class AppStorage{


    storeToken(token){
        localStorage.setItem('token', token);
    }

    storeUser(name){
        localStorage.setItem('name', name);
    }

    store(token, name){
        this.storeToken(token);
        this.storeUser(name);
    }

    clear(){
        localStorage.removeItem('token');
        localStorage.removeItem('name')
    }

    getToken(){
        localStorage.getItem(token);
    }

    getUser(){
        localStorage.getItem(name);
    }

}export default AppStorage = new AppStorage();
