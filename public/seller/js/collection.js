var collection = function() {
    this.data = {
        name: null,
    }

    this.init = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $(document).on('click', '#btn-add', function(event) {
            current.data.name = $('#nameCollection').val();
            if (current.data.name) {
                current.addMyCollection(current.data, current.inform);
            } else {
                alert('Empty');
            }
        });
    }

    this.addMyCollection = function(data, callback) {
        $.ajax({
            url: '/user/collection',
            type: 'POST',
            data: data,
        })
        .done(function(data) {
            callback(data, '');
        })
        .fail(function() {
            alert('error');
        });
    }

    this.inform = function(data, select) {
        switch (data.status) {
            case 'error':
                alert(data.status);
                break;
            case 'success':
                $('.modal#addCollection').modal('hide');
                window.location.reload();
                break;
            case 'validator':
                var str = '';
                for (var key in data.message) {
                    str += key + " : " + data.message[key];
                }
                alert(str);
                break;
        }
    }
}
