<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title>Chatbot</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<script src="js/script.js" defer></script>

<style>
  /* Import Google font - Poppins*/
@import url('https://fonts.googleapis.com/css?family=Poppins: wght@400;500;600&display=swap');
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.chatbot-toggler{
  position:fixed;
  right: 35px;
  bottom: 90px;
  height: 50px;
  width: 50px;
  color: #fff;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  outline: none;
  cursor: pointer;
  background: #724ae8;
  border-radius: 50%;
  transition: all 0.2s ease;
}
.show-chatbot .chatbot-toggler {
  transform: rotate(90deg);
}
.chatbot-toggler span{
  position: absolute;

}
.show-chatbot .chatbot-toggler span:first-child,
.chatbot-toggler span:last-child{
  opacity: 0;
}
.chatbot-toggler span:last-child{
  opacity: 0;
}
.show-chatbot .chatbot-toggler span:last-child {
  opacity: 1;
}
.chatbot{
  position:fixed;
  right: 40px;
  bottom: 100px;
  width: 380px;
  transform: scale(0.5);
  opacity: 0;
  pointer-events: none;
  overflow: hidden;
  background: #fff;
  border-radius: 17px;
  transform-origin: bottom right;
  box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
              0 32px 64px -48px rgba(0,0,0,0.5);
  transition: all 0.1s ease;
}
.show-chatbot .chatbot{
  transform: scale(1);
  opacity: 1;
  pointer-events: auto;
}
.chatbot header{
  background: #724ae8;
  padding: 16px 0;
  text-align: center;
  position: relative;
}
.chatbot header h2{
  color: #fff;
  font-size: 2.1rem;
}
.chatbot header span{
  position: absolute;
  right: 20px;
  top: 50%;
  color: #fff;
  cursor: pointer;
  display: none;
  transform: translateY(-50%);
}
.chatbot .chatbox{
  height: 500px;
  overflow-y: auto;
  padding: 30px 20px 100px;
}
.chatbox .chat{
  display: flex;
}
.chatbox .incoming span{
  height: 32px;
  width: 32px;
  color: #fff;
  align-self: flex-end;
  background: #724ae8;
  text-align: center;
  line-height: 32px;
  border-radius: 4px;
  margin: 0 10px 7px 0;
}
.chatbox .outgoing{
  margin: 20px 0;
  justify-content: flex-end;
}
.chatbox .chat p{
  color: #fff;
  max-width: 75%;
  white-space: pre-wrap;
  font-size: 1.5rem;
  padding: 12px 16px;
  border-radius: 10px 10px 0 10px;
  background: #724ae8;
}
.chatbox .chat p .error{
  color: #721c24;
  background: #f2f2f2;
}
.chatbox .incoming p{
  color: #000;
  background: #f2f2f2;
  border-radius: 10px 10px 10px 0;
  font-size:1.5rem;
}
.chatbot .chat-input{
  position: absolute;
  bottom: 0;
  width: 100%;
  display: flex;
  gap: 5px;
  background: #fff;
  padding: 5px 20px;
  border-top: 1px solid #ccc;
  font-size: 1.7rem;
}
.chat-input textarea{
  height: 55px;
  width: 100%;
  border: none;
  outline: none;
  max-height: 180px;
  font-size: 1.5rem;
  resize: none;
  padding: 16px 15px 16px 0;
}
.chat-input span{
  align-self: flex-end;
  height: 59px;
  line-height: 55px;
  color: #724ae8;
  font-size: 1.7rem;
  cursor: pointer;
  visibility: hidden;
}
.chat-input textarea:valid ~ span{
  visibility: visible;

}

@media(max-width: 490px) {
  .chatbot{
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    border-radius: 0;
  }
  .chatbot .chatbox{
    height: 90%;
  }
  .chatbot header span{
    display: block;
  }
}
</style>
</head>
<body>
<botton class="chatbot-toggler">
    <span class="material-symbols-outlined">mode_comment</span>
    <span class="material-symbols-outlined">close</span>
</botton>
<div class="chatbot">
    <header>
        <h2>Smart Assist</h2>
        <span class="close-btn material-symbols-outlined">close</span>
    </header>
    <ul class="chatbox">
        <li class="chat incoming">
            <span class="material-symbols-outlined">smart_toy</span>
            <p>Hi there <br>How can i help you today?</p>
        </li>
    </ul>
    <div class="chat-input">
        <textarea placeholder="Enter a message..." required></textarea>
        <span id="send-btn"class="material-symbols-outlined">Send</span>
    </div>
</div>
</body>
</html>