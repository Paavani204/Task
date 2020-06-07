
$('#register').submit(function(){
$('#response').html("<b>Loading response...</b>");

$.ajax({
type: 'POST',
url: 'insert.php',
data: $(this).serialize()
})
.done(function(data){ 
$('#response').html(data);
})
.fail(function() { 
alert( "Posting failed." );
});

return false;

});

$('#login').submit(function(){
$('#log').html("<b>Loading response...</b>");

$.ajax({
type: 'POST',
url: 'next.php',
data: $(this).serialize()
})
.done(function(data){ 
$('#log').html(data);

})
.fail(function() { 
alert( "Posting failed." );
});
return false;

});

$('#update').submit(function(){
$('#up').html("<b>Loading response...</b>");

$.ajax({
type: 'POST',
url: 'update.php',
data: $(this).serialize()
})
.done(function(data){
$('#up').html(data);

})
.fail(function() { 
alert( "Posting failed." );
});
return false;

});


$('#del').submit(function(){
$('#de').html("<b>Loading response...</b>");

$.ajax({
type: 'POST',
url: 'delete.php',
data: $(this).serialize()
})
.done(function(data){ 
$('#de').html(data);
})
.fail(function() { 
alert( "Posting failed." );
});

return false;

});

$('#fetch').submit(function(){
$('#fe').html("<b>Loading response...</b>");

$.ajax({
type: 'POST',
url: 'fetch.php',
data: $(this).serialize()
})
.done(function(data){ 
$('#fe').html(data);
})
.fail(function() { 
alert( "Posting failed." );
});

return false;

});

