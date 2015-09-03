@if(getenv('APP_ENV') == 'prod')
    <script>
        (function(f,b){
            var c;
            f.hj=f.hj||function(){(f.hj.q=f.hj.q||[]).push(arguments)};
            f._hjSettings={hjid:16007, hjsv:3};
            c=b.createElement("script");c.async=1;
            c.src="//static.hotjar.com/c/hotjar-16007.js?sv=3";
            b.getElementsByTagName("head")[0].appendChild(c);
        })(window,document);
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-59878036-1', 'auto');
        ga('send', 'pageview');

    </script>
@endif
