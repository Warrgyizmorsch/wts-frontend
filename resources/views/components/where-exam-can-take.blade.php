<style>
    .ielts-section {
        padding: 30px 0;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 0 15px;
    }

    .ielts-title {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 30px;
        position: relative;
        padding-left: 15px;
        text-align: left;
    }

    .ielts-title:before {
        content: '';
        position: absolute;
        left: 0;
        top: 5px;
        width: 5px;
        height: 30px;
        background: #ff7a00;
    }

    .ielts-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .ielts-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
    }

    .ielts-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }

    .ielts-card span {
        position: absolute;
        bottom: 15px;
        left: 15px;
        color: #fff;
        font-size: 20px;
        font-weight: 600;
        z-index: 2;
    }

    .ielts-card:after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, .6), transparent);
    }

    /* Responsive */

    @media(max-width:992px) {
        .ielts-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width:576px) {
        .ielts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="ielts-section">
    <div class="container">
        <h2 class="ielts-title">Where {{$exam}} can take you?</h2>

        <div class="ielts-grid">
            <div class="ielts-card">
                <img src="images/australia.jpg">
                <span>Australia</span>
            </div>

            <div class="ielts-card">
                <img src="images/canada.jpg">
                <span>Canada</span>
            </div>

            <div class="ielts-card">
                <img src="images/country/ukhome.webp">
                <span>UK</span>
            </div>

            <div class="ielts-card">
                <img src="images/usa.jpg">
                <span>USA</span>
            </div>

            <div class="ielts-card">
                <img src="images/germany.jpg">
                <span>Germany</span>
            </div>

            <div class="ielts-card">
                <img src="images/country/newzealandhome.webp">
                <span>New Zealand</span>
            </div>
        </div>
    </div>
</section>