// @ts-nocheck
import axios from "axios";

class Rest
{


    constructor(){
        console.log({ config : window });
        this.base_url =  ( window.config && window.config.base_url ) ? window.config.base_url : 'http://127.0.0.1:8000';
    }

    /**
     *
     * @param { String } url
     * @param { GET|POST|PUT|PATCH } method
     * @param { Object[]} params
     * @param { Object[]} data
     * @returns { Promise }
     */
    request( url = "", method ="GET", params = {}, data = {} , header = {}  )
    {
        console.log({ data });
        // @ts-ignore
        return axios({
            url : this.base_url + url,
            method : method,
            params : params,
            data : data,
            header : header,
            responseType : 'json',
        });
    }
}

export default Rest;
