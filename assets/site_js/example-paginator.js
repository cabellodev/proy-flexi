

    let products_colection = [];

    function simpleTemplating(data) {
        var html = '<ul>';
        $.each(data, function(index, item){
            html += '<li>'+ item +'</li>';
        });
        html += '</ul>';
        return html;
    }


    $('#view-data').pagination({
        dataSource: [1, 2, 3, 4, 5, 6, 7,1,2,3,4,5,6, 195],
        pageSize: 5,
        showPrevious: true,
        showNext: true,
        callback: function(data, pagination) {
            var html = simpleTemplating(data);
            $('#pagination').html(html);
        }
    })
    
   
   

