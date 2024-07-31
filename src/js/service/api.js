class Api {
    constructor() {
        this.baseUrl = URL_API
        this.header = {
            'Accept': 'application/json',
        };

        this.token = localStorage.getItem('token')
        this.setAccessToken(this.token);
    }

    setAccessToken(token) {
        return new Promise(resolve => {
            if (!token) {
                this.setHeader(token);
                resolve();
            } else {
                this.setHeader(token);
                resolve();
            }
        });
    }

    setHeader(token) {
        if (token) {
            this.header['Authorization'] = 'Bearer ' + token;
        } else {
            delete this.header['Authorization'];
        }
    }

    ajaxRequest(method, data = {}) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: this.baseUrl,
                type: method,
                data: data,
                headers: this.header,
                success: function(response) {
                    resolve(response);
                },
                error: function(xhr, textStatus, error) {
                    //melhorar isso aqui, casos onde token expirou, remover localstorage dados como token user
                    if (xhr.status === 401) {
                        localStorage.removeItem('token');
                        localStorage.removeItem('classUser');
                    }

                    reject(xhr.statusText);
                }
            });
        });
    }

    get(params = {}) {
        const queryString = $.param(params);

        return this.ajaxRequest('GET', queryString);
    }

    post(data = {}) {
        return this.ajaxRequest('POST', data);
    }

    put(data = {}) {
        return this.ajaxRequest('PUT', data);
    }

    delete(data = {}) {
        return this.ajaxRequest('DELETE', data);
    }
}

const api = new Api();
