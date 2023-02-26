function hideFixedItems(item){
    $(item).removeClass('show');
    $(item).fadeOut('slow');
    $('#global-fixed-overlay').fadeOut('slow');
}
function showFixedItems(item){
    //$(item).removeClass('show');
    $(item).fadeIn('slow');
    $('#global-fixed-overlay').fadeIn('slow');
}


function getFileSize(url)
{
    var fileSize = '';
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false); // false = Synchronous

    http.send(null); // it will stop here until this http request is complete

    // when we are here, we already have a response, b/c we used Synchronous XHR

    if (http.status === 200) {
        fileSize = http.getResponseHeader('content-length');
    }

    return fileSize;
}

// remove tag from tist
function removeThisTag(element){
    let tags = $('#tags').val();
    let tagElement = element.getAttribute('data-tag');
    tags = tags.replace(tagElement, "");
    tags = tags.trimStart();
    tags = tags.trimEnd();
    tags = tags.trim();
    $('#tags').val(tags);
    $('#tags').text(tags);
    $('#tags').html(tags);
    element.remove();
}

// chose file from media
function chosefileFromMedia(element){
    let id = '';
    let file = '';
    $.get({
        url:'/admin/medias/getjson',
        success : function(res){
            let data = JSON.parse(res);
            let mediaList = '';
            let absStorageUrl = $('meta[name="site-storage-url"]').attr('content');
            $.each(data, function( i, value ) {
                mediaList += '<li class="list-inline-item">';
                mediaList += '<div class="media-grid-thumbnail"><img title="'+value['name']+'" alt="'+value['alt_title']+'" description="'+value['file_desc']+'" data-type="'+value['type']+'" data-id="'+value['id']+'" data-time="'+value['created_at']+'"  class="img-fluid" src="'+absStorageUrl+'/'+value['file']+'" ></div>';
                mediaList += '</li>';
            });
            $('#instant-medias-chose-and-upload').fadeIn();
            $('#global-fixed-overlay').fadeIn();
            $('.medias-list').html(mediaList);
            $('.media-grid-thumbnail').click(function(){
                $('.media-grid-thumbnail').removeClass('selected'); 
                $(this).toggleClass('selected'); 
                $('#media-grid-selected-item-id').val($(this).children('img').attr('data-id'));
                $('#media-grid-selected-item-file').val($(this).children('img').attr('src'));
            });
            $(".chose-selected-media").click(function(){
                id = $('#media-grid-selected-item-id').val(); 
                file = $('#media-grid-selected-item-file').val(); 
                $('#instant-medias-chose-and-upload').fadeOut();
                $('#global-fixed-overlay').fadeOut();
                element.find('input[type="text"]').val(id);
                element.find('img').attr('src',file);
                return false;
            });
        }
    });
}

function removeThisRow(row){
    let id  = $(row).parents('.form-row').find('input[name="id[]"]').val();
    if(id == ''){
        $(row).parents('.form-row').remove();
    }else{
        $.get({
            url:'/admin/parametres/villes/supprimer/'+id,
            success: function(res){
                if(res == 1){
                    $(row).parents('.form-row').remove();
                }
            } 
        });
    }
}
function getnerateSlugname(element){
    //$('input[name="title[]"]').keyup(function(){
        let data = $(element).val();
        data = data.split(' ').join('-');
        data = data.toLowerCase();
       // data = encodeURI(data);
        $(element).parents('.form-row').find('input[name="sub_title[]"]').val(data);
    //});
    }