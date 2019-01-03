new Vue({
    el: '#vue-app',
    data: {
        name: 'Alex',
        users: {},
        urls: []
    },

    created: function () {
        var api = this.$http;

        this.$http.get('http://localhost:8888/index.php?format=json')
            .then(function (response) {
                this.urls = response.data;
                this.urls = this.urls.map(function (url, index) {
                    url.status = 2;
                    api.get('http://localhost:8888/index.php?format=json&debug=3&site=' + url.id)
                        .then(function (response) {
                            if (response.data) {
                                var key = Object.keys(response.data);
                                var value = response.data[key];
                                this.urls[index].status = value === true ? 1 : 0;

                                this.urls = this.urls.slice();
                            }
                        });
                    return url;
                });
            });
    }

});