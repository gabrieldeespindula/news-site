var i = 0;
function getNews() {
    $.ajax({
        url: 'http://localhost/www/news/database/select.php',
        method: 'GET',
        dataType: 'json'
    }).done(function(result){
        console.log(result);

        for (i; i < 6; i++) {
            $('.noticia').append('<div class="card mx-auto my-5" width="360px"><div class="card-body text-center"><img class="rounded img-fluid" height="350px" width="350px" src="data:image;base64,'+ result[i].img +'"/></div><div class="card-body text-center"><a class="h6 card-text" href="readnews.php?id='+ result[i].Id +'">'+ result[i].titulo +'</a><h6 class="card-subtitle my-2 text-muted">'+ result[i].data +'<h6></div></div>');
        }
    });
}
getNews();
function vejaMais(){
    $.ajax({
        url: 'http://localhost/www/news/database/select.php',
        method: 'GET',
        dataType: 'json'
    }).done(function(result){
        console.log(result);

        var max = result.length;
        var limite = i+2;

        for (i; i < limite ; i++) {
            $('.noticia').append('<div class="card mx-auto my-5" width="360px"><div class="card-body text-center"><img class="rounded img-fluid" height="350px" width="350px" src="data:image;base64,'+ result[i].img +'"/></div><div class="card-body text-center"><a class="h6 card-text" href="readnews.php?id='+ result[i].Id +'">'+ result[i].titulo +'</a><h6 class="card-subtitle my-2 text-muted">'+ result[i].data +'<h6></div></div>');
        }
    });
}