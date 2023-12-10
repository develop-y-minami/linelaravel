/**
 * FetchApi
 * 
 */
class FetchApi {
    /**
     * APIルート
     * 
     */
    static URL_ROOT_API = 'http://127.0.0.1:8000/api';
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
            let response = await fetch(FetchApi.URL_ROOT_API + '/' + url);
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

    /**
     * HTTP Method POST
     * 
     * @param {string} url  URL
     * @param {object} data データ
     * @returns {object}
     */
    static async post(url, data = {}) {
        try {
            let response = await fetch(
                FetchApi.URL_ROOT_API + '/' + url,
                {
                    method: 'post',
                    headers: 
                    {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }
            );
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