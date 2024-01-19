<div id="myModal" class="modal grid gridmodal">
    <div class="modal-keeper">
        <span class="close">&times;</span>
        <div class="modal-anime">
                <img class="modal-contents mb-1" id="img01" alt="" style="border-radius: 5px">
                <div id="caption" style="border-radius: 5px"></div>
        </div>
    </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    // var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    function popup(pop, text) {
        modal.style.display = "block";
        modalImg.src = pop;
        captionText.innerHTML = text;
    }

    myModal.onclick = function() {
        modal.style.display = "none";
    }
</script>
