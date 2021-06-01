import Token from './Token';
import AppStorage from './AppStorage';

class User{

    resAfterLogin(result){
        const access_token = result.data.access_token;
        const name = result.data.name;
        if (Token.isValid(access_token)){
            AppStorage.store(access_token, name);
            //console.log(access_token, name);
        }
    }

    hasToken(){
        const storeToken = localStorage.getItem('token');
        if(storeToken){
            return Token.isValid(storeToken) ? true : false;
        }
    }

    loggedIn(){
        return this.hasToken();
    }

    name(){
        if(this.loggedIn()){
            return localStorage.getItem('name');
        }
    }

    id(){
        if(this.loggedIn()){
            const payload = Token.payload(localStorage.getItem('token'));
            return payload.sub
        }

        return false
    }

}
export default User = new User();
