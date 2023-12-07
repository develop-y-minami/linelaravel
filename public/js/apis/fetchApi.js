/**
 * FetchApi
 * 
 */
class FetchApi {

    /**
     * STATUS 成功
     * 
     */
    static STATUS_SUCCESS = 'success';

    /**
     * STATUS 失敗
     * 
     */
    static STATUS_FAILURE = 'failure';

    /**
     * HTTP Method GET
     * 
     * @param {string} url - URL
     * @returns {object}
     */
    static async get(url) {
        try {
            let response = await fetch(URL_ROOT_API + '/' + url);
            if (response.ok) {
                let data = await response.json();
                return {'status' : 'success', 'data' : data};
            } else {
                return {'status' : 'failure', 'error' : response.statusText};
            }
        } catch(error) {
            return {'status' : 'failure', 'error' : error};
        }
    }

}