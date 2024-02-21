<div id="mapModal" class="modal grid gridmodal">
    <div class="modal-keeper">
        <span class="close">&times;</span>
        <div class="modal-anime">
                <div id="maper" class="modal-contents mb-1"></div>
                {{-- <div id="mapCap"></div> --}}
        </div>
    </div>
</div>

<script>
    var mapper = document.getElementById("mapModal");
    var modalMap = document.getElementById("maper");
    // var mapperText = document.getElementById("mapCap");

    function popupMap(pop) {
        mapper.style.display = "block";
        modalMap.innerHTML = pop;
        // mapperText.innerHTML = text;
        // mapperText.style.display = display;
    }

    mapModal.onclick = function() {
        mapper.style.display = "none";
    }
</script>
