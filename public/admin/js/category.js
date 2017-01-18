var category = function() {
    this.data = {
        imageAwait: null,
        categoryId: null,
        parentName: null,
    }

    this.dataEditCategory = {
        name: null,
        sort: null,
        parent_id: null,
        image: null,
    }

    this.element = {
        elementSelected: null,
    }

    this.init = function(data) {
        this.data.imageAwait = data.imageAwait;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('.fa.fa-pencil.fa-fw.edit').on('click', function(event) {
            $.blockUI({ message: '<img src="' + current.data.imageAwait + '"/>' });
            current.data.categoryId = $(this).data('id');
            current.editCategory($(this).data('id'));
            current.element.elementSelected = this;
        });

        $('#btnEdit').on('click', function(event) {
            current.dataEditCategory.name = $('#category-name').val();
            current.dataEditCategory.sort = $('#sort').val();
            current.dataEditCategory.parent_id = $('#parent_id').val();
            current.data.parentName =  $('#parent_id :selected').text();
            current.update(current.dataEditCategory, current.data.categoryId,
                current.inform, current.element.elementSelected);
        });
    }

    this.editCategory = function(categoryId) {
        $.ajax({
            url: '/admin/category/' + categoryId + '/edit',
            type: 'GET',
        })
        .done(function(data) {
            $('.modal#modalEdit .modal-content .modal-form').html(data);
            $.unblockUI();
            $('.modal#modalEdit').modal();
        });        
    }

    this.update = function(data, categoryId, callback, select) {
        $.ajax({
            url: '/admin/category/' + categoryId,
            type: 'PATCH',
            data: data,
        })
        .done(function(data) {
            callback(data, select);
        });
    }

    this.inform = function(data, select) {
        switch (data.status) {
            case 'error':
                alert(data.status);
                break;
            case 'success':
                $('.modal#modalEdit').modal('hide');
                $parent = $(select).parentsUntil('class', '.odd');
                $parent.children('td.name').html(data.data.name);
                $parent.children('.sort').html(data.data.sort);
                $parent.children('.parent').html($('#parent_id :selected').text());
                break;
            case 'validator':
                var str = '';
                for (var key in data.message) {
                    str += key + ": " + data.message[key];
                }
                alert(str);
                break;
        }
    }
}
