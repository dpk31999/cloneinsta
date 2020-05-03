$(document).ready(function(){
    var engine1 = new Bloodhound({
        remote: {
            url: '/search?value=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $(".search-input").typeahead({
        hint: true,
    }, [
        {
            source: engine1.ttAdapter(),
            name: 'students-name',
            display: function(data) {
                return data.name;
            },
            templates: {
                empty: [
                    '<div class="header-title mt-2" style="width: 220px;"></div><div class="list-group search-results-dropdown"><div class="list-group-item">No result found.</div></div>'
                ],
                header: [
                    '<div class="header-title mt-2" style="width: 220px;></div><div class="list-group search-results-dropdown"></div>'
                ],
                suggestion: function (data) {
                    return '<a href="/profile/' + data.id + '" class="list-group-item text-decoration-none text-dark link-info"><div><div><strong>' + data.username + '</strong></div><div>'+ data.name +'</div></div></a>';
                }
            }
        }, 
    ]);   
});