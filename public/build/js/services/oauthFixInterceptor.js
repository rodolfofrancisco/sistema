angular.module('app.services')
.service('oauthFixInterceptor', ['$interpolate', function($q, $rootScope, OAuthToken) {
    return {
        request: function(config) {
            if (OAuthToken.getAuthorizationHeader()) {
                config.headers = config.headers || {}
                config.headers.Authorization = OAuthToken.getAuthorizationHeader()
            }
            return config;
        },
        responseError: function(rejection) {
            var deferred = $q.defer()
            if (400 === rejection.status && rejection.data && ("invalid_request" === rejection.data.error || "invalid_grant" === rejection.data.error)) {
                OAuthToken.removeToken();
                $rootScope.$emit("oauth:error", { rejection: rejection, deferred: deferred });
            }
            if (401 === rejection.status && rejection.data && "invalid_token" === rejection.data.error || rejection.headers && rejection.headers("www-authenticate") && 0 === rejection.headers("www-authenticate").indexOf("Bearer")) {
                $rootScope.$emit("oauth:error", { rejection: rejection, deferred: deferred });
            }
            
            return deferred.promise
        }
    };
}])