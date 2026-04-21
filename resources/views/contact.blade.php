<x-layout>
<style>
    .page-container { max-width: 800px; margin: 0 auto; padding: 40px 20px; }
    .page-title { font-size: 3rem; font-weight: 900; text-transform: uppercase; font-style: italic; margin-bottom: 2rem; color: #000; }
    
    .info-card { 
        background: white; 
        border: 4px solid black; 
        padding: 2.5rem; 
        border-radius: 2rem; 
        box-shadow: 10px 10px 0px 0px rgba(0,0,0,1);
    }

    form label { 
        display: block; 
        font-weight: 900; 
        text-transform: uppercase; 
        font-size: 0.8rem; 
        margin-bottom: 0.5rem;
        color: #555;
    }

    form input, form textarea {
        width: 100%;
        padding: 15px;
        margin-bottom: 1.5rem;
        border: 3px solid black;
        border-radius: 1rem;
        font-weight: 700;
        outline: none;
        transition: background 0.2s;
    }

    form input:focus, form textarea:focus {
        background: #fff9f9;
        border-color: #dd0d22;
    }

    .btn {
        background: black;
        color: white;
        padding: 15px 30px;
        border-radius: 1rem;
        font-weight: 900;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        box-shadow: 0px 4px 0px 0px #444;
        transition: all 0.2s;
    }

    .btn:hover {
        background: #dd0d22;
        box-shadow: 0px 4px 0px 0px #800714;
        transform: translateY(-2px);
    }
</style>

<div class="page-container">
    <h1 class="page-title">Contact <span style="color: #dd0d22;">Us</span></h1>

    <div class="info-card">
        <form action="#" method="POST">
            @csrf
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Juan Dela Cruz">

            <label>Email Address</label>
            <input type="email" name="email" placeholder="juan@example.com">

            <label>Message</label>
            <textarea name="message" rows="5" placeholder="How can we help your shopping experience?"></textarea>

            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</div>
</x-layout>