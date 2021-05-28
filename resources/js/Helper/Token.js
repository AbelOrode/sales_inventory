class Token{

  isValid(token){
    const payload = this.payload(token);
    if (payload){
        return payload.iss = "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/register" ? true : false;
    }
        return false;
  }

  payload(token){
      const payload = token.split('.')[1];
      return this.decode(payload);
  }

  decode(payload){
      return JSON.parse(atob(payload)) // The atob() functions decodes a base 64 encoded strings. In this case, it is used in decoding generated token.
  }
}

export default Token = new Token();
