$("document").ready(function(){
    
    $("#register").on("click",function()
    {
        $(".first").slideUp("slow",function(){
            $(".second").slideDown();
        });
    })
    
    $("#login").on("click",function()
    {
        $(".second").slideUp("slow",function(){
            $(".first").slideDown();
        });
    });
})