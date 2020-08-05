<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
.chat-container{
width: 100%;
margin: 0;
padding: 0;
max-width: 340px;
height: auto;
position: fixed;
bottom: 0;
right: 15px;
z-index: 999;
}

.chat-button{
width: 100%;
margin: 0;
cursor: pointer;
user-select: none;
padding: 4px 0;
text-align: center;
}

.chat-content{
margin: 0;
padding: 0;
display: none;
background-color: #fff;
}
</style>

<section class="chat-container">
    <div class="chat-button btn btn-warning rounded-pill">
        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-chat-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
            <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
        </svg>  
    </div>
    <div class="chat-content">
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCremeria-Liz-215060466586799%2F%3Fmodal%3Dadmin_todo_tour&tabs=messages&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>
</section>

<script>
$(document).ready(function() {
   $(".chat-button").on('click', function(e){
       e.preventDefault();
       $(".chat-content").slideToggle("fast");
   });
});
</script>