<section id="Footer">
    <div class="footer-area text-sm">
        <div class="row justify-content-between ">
            <div class="col-12 col-md-6 col-xxl-4 foot-order2">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col">
                            <div class="bold mb-2">{{ $category->name }}</div>
                            @foreach (collect($pages)->where('category_id', $category->id) as $page)
                                <div>
                                    <a href="{{ $url }}/{{ Str::lower($page->link) }}">&#x2022;
                                        {{ $page->link }}</a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6 foot-order1">
                <div class="mb-2 footer-logo text-color bold">Oracle Sound Lab</div>
                <div class="mb-2">Record Label &amp; Streaming.<br>Bali Indonesia.</div>
                <div class="">
                    <i class="bi bi-envelope text-color me-1"></i> <a href="mailto:admin@oraclesoundlab.com">
                        <span id="mail"></span></a>
                    <script>
                        document.getElementById('mail').innerHTML = 'admin' + '@' + 'oraclesoundlab.com';
                    </script>
                    <br>
                    <i class="bi bi-telephone text-color me-1"></i> <a href="tel:+6281338383288">
                        <span id="phone"></span></a>
                    <script>
                        document.getElementById('phone').innerHTML = '+62' + '-' + '813-3838-3288';
                    </script>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-between">
            <div class="socmed foot-order2 col-12 col-md-4 col-lg-4 col-xxl-4">
                <div class="row">
                    <div class="col"><a href="https://www.instagram.com/oraclesoundlabdnb/"><i
                                class="bi bi-instagram"></a></i></div>
                    <div class="col"><a href="https://twitter.com/oraclesoundlab"><i class="bi bi-twitter"></i></a>
                    </div>
                    <div class="col"><a href="https://www.tiktok.com/@oraclesoundlabdnb"><i
                                class="bi bi-tiktok"></i></a></div>
                    <div class="col"><a href="https://open.spotify.com/playlist/0rrYlaiFGwyNyPA2zXpYV3"><i
                                class="bi bi-spotify"></i></a></div>
                    <div class="col"><a href="https://www.youtube.com/@OracleSoundlab/videos"><i
                                class="bi bi-youtube"></i></a></div>
                </div>
            </div>
            <div class="copyright foot-order1 col-12 col-md-6">Copyright © {{ date('Y') }}. Oracle Sound
                Lab<br>All
                rights reserved.</div>
        </div>
    </div>
</section>
