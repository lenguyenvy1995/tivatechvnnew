@if ($content = $shortcode->content_text)
<section @style(["--background-color: $shortcode->background_color" => $shortcode->background_color])  class="pb-5 shortcode-content-quote">


    <div class="container" >
        <blockquote
           
           
        >
        <div class="tg-heading-subheading animation-style3">
            <p class=" tg-element-title">
                {!! BaseHelper::clean($content) !!}
            </p>
        </div> 
        </blockquote>
    </div>
</section>
@endif
