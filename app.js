new Vue({
    el: '#vue-app',
    data: {
        name: 'Alex',
        users: {},
        urls: []
    },

    created: function () {
        var api = this.$http;
        var that = this;

        this.$http.get('https://jsonplaceholder.typicode.com/users')
            .then(function (response) {
                this.users = response.data;
                this.users = this.users.map(function (user) {
                    user.status = Math.round(Math.random());
                    return user;
                });
                console.log(this.users);
            });
        this.$http.get('http://localhost:8888/index.php?format=json')
            .then(function (response) {
                this.urls = response.data;
                this.urls = this.urls.map(function (url) {
                    url.status = Math.round(Math.random()) + Math.round(Math.random());
                    return url;
                });

                this.urls.forEach(function (url, index) {
                    console.log('Inside for each' + url.id);
                    api.get('http://localhost:8888/index.php?format=json&site='+url.id)
                        .then(function (response) {
                            if(response.data) {
                                var key = Object.keys(response.data);
                                var value = response.data[key];
                                this.urls[index].status = value === true ? 1 : 0;
                                that.$forceUpdate();
                                that.$forceUpdate();
                            }
                            console.log('Inside for each after fetch: ', url);
                        });
                });
            });


    }

});