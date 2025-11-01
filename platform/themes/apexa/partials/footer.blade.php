@php
    $backgroundColor = theme_option('footer_background_color', '#FFFFFF');
    $textColor = theme_option('footer_text_color', theme_option('text_color', '#3E4073'));
    $headingColor = theme_option('footer_heading_color', theme_option('primary_color', '#14176C'));
    $backgroundImage = theme_option('footer_background_image');
    $borderColor = theme_option('footer_border_color', '#CFDDE2');
    $bottomBackgroundColor = theme_option('footer_bottom_background_color', '#ECF6FA');
    $backgroundImage = $backgroundImage ? RvMedia::getImageUrl($backgroundImage) : null;
@endphp

{!! dynamic_sidebar('top_footer_sidebar') !!}
<footer id="footer" @style([
    "--footer-background-color: $backgroundColor",
    "--footer-heading-color: $headingColor",
    "--footer-text-color: $textColor",
    "--footer-border-color: $borderColor",
    "--footer-bottom-background-color: $bottomBackgroundColor",
    "--footer-background-image: url($backgroundImage)" => $backgroundImage,
])>
    <div class="footer-area">
        <div class="footer-top pt-5 pb-0">
            <div class="container">
                <div class="row wrapper-footer-widgets">
                    {!! dynamic_sidebar('footer_sidebar') !!}
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <h4 class="fw-title">Bản đồ</h4>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.6700045307994!2d106.70107271203962!3d10.83654605803448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529b7b3d36b47%3A0x9f595be465e75d98!2zQ8O0bmcgVHkgVE5ISCBUaGnhur90IEvhur8gVsOgIFF14bqjbmcgQ8OhbyBUaXZhdGVjaA!5e0!3m2!1svi!2s!4v1760069759222!5m2!1svi!2s" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                </div>
            </div>
        </div>
        @if ($items = Theme::getSocialLinks())
        <div class="text-center offCanvas__social-icon my-3">
            @foreach ($items as $item)
                <a title="{{ $item->getName() }}" target="_blank" href="{{ $item->getUrl() }}">
                    {!! $item->getIconHtml() !!}
                </a>
            @endforeach
        </div>
    @endif
        <div id="footer-bottom" class="footer-bottom mb-5">
            <div class="container">
                <div class="d-flex gap-3 justify-content-center align-items-center bottom-footer-wrapper">
                    {!! dynamic_sidebar('bottom_footer_sidebar') !!}
                </div>
            </div>
        </div>
    </div>
    
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>