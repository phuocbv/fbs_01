var myApp = function() {
    this.remove = function() {
        if (window.location.hash && window.location.hash == '#_=_') {
            window.location.hash = '';
        }
    }
}
