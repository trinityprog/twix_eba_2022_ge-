<footer>
    <div class="container">
        <p class="title">
            @lang('index.footer.period')
        </p>

        <nav>
            @lang('index.footer.rights') <br>
            <a href="{{ url('#privacy') }}">@lang('index.footer.links.privacy')</a> |
            <a href="{{ url('#owner') }}">@lang('index.footer.links.owner')</a> |
            <a href="{{ url('#parents') }}">@lang('index.footer.links.parents')</a> |
            <a href="{{ url('https://www.mars.com/covid-19') }}">to Mars global COVID-19 statement</a> |
            <a href="{{ url('#terms') }}">@lang('index.footer.links.terms')</a> |
            <a href="{{ url('#contacts') }}">@lang('index.footer.links.contacts')</a>
        </nav>
    </div>
</footer>
