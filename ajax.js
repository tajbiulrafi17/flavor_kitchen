$(document).ready(function(){
        const liveSearchResult = $('.live-search-result')

        $('#form-search input').keyup(function(){

            var input = $(this).val();

            if(input != ""){
                liveSearch($(this).val())
                if($(this).val()){
                    liveSearchResult.show();
                }
            }else{
                liveSearchResult.hide();
            }


        })
        $('#form-search input').blur(function(){
            liveSearchResult.hide();
            
        })

        $('.live-search-result .search-result').mousedown(function(e){
            e.preventDefault();
        })

        function liveSearch(keyword){
            $.ajax({
                url: "ajax.php",
                type: "GET", 
                data: {
                    action: 'search-result',
                    keyword: keyword
                },
                datatype: "json",
                success: function(result){
                    const divSearchResult = $('.live-search-result .search-result');
                    let html = `<li style="padding: 8px 12px"><h3 class="text-red"> We Have, <h3></li>`
                    
                    result = JSON.parse(result);
                    // console.log(result);
                    if(result.length > 0){
                        
                        $.each(result, function(index, item){
                            html += `<li>
                                        <h4 class="text-white"> ${item['title']} <h4>
                                    </li>`
                        })
                    }
                    else{
                        html = `<li style="padding: 8px 12px"><h4 class="text-red"> Sorry, No item matched <h4></li>`
                    }
                    divSearchResult.html(html);
                }
            })
        }
    })