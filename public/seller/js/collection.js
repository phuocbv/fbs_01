var collection = function() {
    this.data = {
        name: null,
    }

    this.dataPage = {
        items: null,
        itemsOnPage: null,
    }

    this.init = function(data) {
        this.dataPage.items = data.items;
        this.dataPage.itemsOnPage = data.itemsOnPage;
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
        $('.paginate').pagination({
            items: current.dataPage.items,
            itemsOnPage: current.dataPage.itemsOnPage,
            cssStyle: 'light-theme',
            hrefTextPrefix: 'javascript:void(',
            hrefTextSuffix: ')',
            onPageClick: function(pageNumber) {
                current.loadCollection(pageNumber);
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

    this.loadCollection = function(pageNumber) {
        $.ajax({
            url: '/user/myCollection',
            type: 'GET',
            data: { page: pageNumber },
        })
        .done(function(data) {
            $('.item-collection').html(data);
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
