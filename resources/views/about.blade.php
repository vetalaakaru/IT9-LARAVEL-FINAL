<x-layout>
<style>
    :root {
        --orange: #ff4a00;
        --red: #dd0d22;
        --cream: #f3e3cb;
    }
    
    /* Scoped styles to prevent layout bleeding */
    .page-container { 
        max-width: 800px; 
        margin: 0 auto; 
        padding: 40px 20px; 
    }
    
    .page-title { 
        font-size: 3rem; 
        font-weight: 900; 
        text-transform: uppercase; 
        font-style: italic; /* Fixed: Added property name to resolve semicolon error */
        margin-bottom: 2rem; 
        color: #000; 
        letter-spacing: -0.05em;
    }
    
    .info-card { 
        background: white; 
        border: 4px solid black; 
        padding: 2.5rem; 
        border-radius: 2rem; 
        margin-bottom: 2rem;
        box-shadow: 10px 10px 0px 0px rgba(0,0,0,1);
        transition: transform 0.2s ease;
    }

    .info-card:hover {
        transform: translate(-2px, -2px);
    }

    .grid-2 { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 24px; 
    }

    .card-heading {
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @media (max-width: 600px) { 
        .grid-2 { grid-template-columns: 1fr; } 
    }
</style>

<div class="page-container">
    <h1 class="page-title">About <span style="color: var(--red);">CraveCart</span></h1>

    <div class="info-card">
        <p class="font-bold text-lg leading-relaxed">
            CraveCart is your modern essential marketplace built for a fast,
            affordable, and reliable shopping experience. We bring the 
            freshest essentials directly to your screen.
        </p>
    </div>

    <div class="grid-2">
        <div class="info-card">
            <h3 class="card-heading" style="color: var(--orange);">
                <span>🎯</span> Mission
            </h3>
            <p class="font-medium text-gray-700">To simplify online shopping for everyday essentials through innovation.</p>
        </div>

        <div class="info-card">
            <h3 class="card-heading" style="color: var(--red);">
                <span>🚀</span> Vision
            </h3>
            <p class="font-medium text-gray-700">To become the leading essentials marketplace in the Philippines.</p>
        </div>
    </div>
</div>
</x-layout>