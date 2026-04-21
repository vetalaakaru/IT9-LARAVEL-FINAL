<x-layout>
<div class="messages-page" style="background-color: #fffaf7; min-height: 100vh; padding: 40px 20px;">
    <div class="messages-container" style="max-width: 1100px; margin: 0 auto; background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); display: flex; height: 75vh; overflow: hidden; border: 1px solid #ffe8db;">
        
        <div class="inbox-sidebar" style="width: 350px; border-right: 1px solid #ffe8db; display: flex; flex-direction: column;">
            <div style="padding: 25px; border-bottom: 1px solid #fff0e6;">
                <h2 style="color: #ff6b00; margin: 0 0 15px 0; font-size: 1.5rem;">Messages</h2>
                <div style="position: relative;">
                    <input type="text" placeholder="Search conversations..." style="width: 100%; padding: 12px 15px 12px 40px; border-radius: 10px; border: 1px solid #ffe8db; background: #fffaf7; font-family: 'Poppins', sans-serif;">
                    <span style="position: absolute; left: 15px; top: 12px; color: #ff6b00;">🔍</span>
                </div>
            </div>
            
            <div class="conversation-list" style="flex: 1; overflow-y: auto;">
                <div class="conv-item active" style="padding: 20px; background: #fff5f0; border-left: 5px solid #ff6b00; cursor: pointer;">
                    <h4 style="margin: 0; color: #333;">Seller: Item Owner</h4>
                    <p style="margin: 5px 0 0 0; color: #666; font-size: 0.85rem;">Regarding: {{ request('item', 'Item Inquiry') }}</p>
                </div>
            </div>
        </div>

        <div class="chat-main" style="flex: 1; display: flex; flex-direction: column; background: white;">
            <div style="padding: 20px 30px; border-bottom: 1px solid #ffe8db; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; color: #333;">Negotiating for: <span style="color: #ff6b00;">{{ request('item', 'General Inquiry') }}</span></h3>
                    <span style="font-size: 0.8rem; color: #2ecc71;">● Online</span>
                </div>
            </div>

            <div style="flex: 1; padding: 30px; overflow-y: auto; background: #fffcfb; display: flex; flex-direction: column; gap: 20px;">
                <div style="align-self: flex-start; max-width: 70%;">
                    <div style="background: #f1f1f1; padding: 15px 20px; border-radius: 15px 15px 15px 0; color: #444; line-height: 1.5;">
                        Hi! I saw you are interested in lending my {{ request('item', 'item') }}. How long do you need it for?
                    </div>
                    <small style="color: #999; margin-top: 5px; display: block;">3:32 AM</small>
                </div>
            </div>

            <div style="padding: 25px; border-top: 1px solid #ffe8db;">
                <form style="display: flex; gap: 15px;">
                    <input type="text" placeholder="Type your message here..." style="flex: 1; padding: 15px 20px; border-radius: 30px; border: 1px solid #ffe8db; outline: none; font-family: 'Poppins', sans-serif;">
                    <button type="submit" style="background: #ff6b00; color: white; border: none; padding: 0 30px; border-radius: 30px; font-weight: 600; cursor: pointer; transition: 0.3s;">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-layout>