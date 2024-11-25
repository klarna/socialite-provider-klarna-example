<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in with Klarna - Socialite Example</title>
    <style>
      :root{--current-gap: 0px}
      .klarna-sdk-button-container{
        width:335px;
        height:48px;
        display:inline-block
      }
      #klarna-sdk-button {
        container-type:inline-size;
        container-name:sdk-button-content;
        position:relative;
        height:inherit;
        width:inherit;
        min-width:48px;
        min-height:35px;
        max-height:60px;
        padding:0;
        outline:none;
        border:0;
        margin:0;
        background-color:rgba(0,0,0,0)
      }

      #klarna-sdk-button:focus #klarna-sdk-button__outline {
        position:absolute;
        inset:-4px;
        border:2px solid #0d0e0f;
        border-radius:8px;
        min-height:inherit;
        max-height:64px;
        margin:auto 0
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container{
        display:inline-block;
        min-height:inherit;
        max-height:inherit;
        min-width:inherit;
        width:inherit;
        height:inherit;
        cursor:pointer;
        transition:background-color .2s ease;
        box-sizing:border-box;
        border-radius:8px
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text {
        font-family:"-apple-system","BlinkMacSystemFont","Segoe UI","Roboto","Arial","sans-serif";
        height:inherit;
        font-size:16px;
        opacity:1;
        transition:color .2s ease;
        text-rendering:optimizeLegibility;
        white-space:nowrap;
        max-height:inherit;
        min-height:inherit;
        position:relative;
        display:flex;
        justify-content:center;
        align-items:center;
        --current-gap: 14px;
        gap:6px;
        margin:0 var(--current-gap) 0 var(--current-gap)
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text.hidden{
        opacity:0
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text--center{
        display:flex;
        justify-content:center;
        align-items:center;
        gap:6px
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo{
        width:24px;
        height:24px
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{
        width:inherit;
        height:inherit
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text #badge{
        width:64px;
        height:28px
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text #badge svg{
        width:inherit;
        height:inherit
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text #copy{
        flex:1 1 0%
      }

      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text #copy--center{flex:0 1 0%}
      #klarna-sdk-button #klarna-sdk-button__inner-container #klarna-sdk-button__text #copy--right{
        flex:1 1 0%;
        margin-left:
        calc(var(--current-gap) + 20px)
      }

      .hideLogo{display:none}

      @container sdk-button-content (width > 199px){}
      @container sdk-button-content (width < 200px){
        #klarna-sdk-button #copy{display:none}
        #klarna-sdk-button #badge{display:inline-block}
        #klarna-sdk-button #logo{display:none}
      }
      @container sdk-button-content (width < 80px){
        #klarna-sdk-button{gap:0}
        #klarna-sdk-button #logo{display:inline-block}
        #klarna-sdk-button #badge{display:none}
        #klarna-sdk-button #copy{display:none}
        #klarna-sdk-button #klarna-sdk-button__text--center #logo{margin:0}
        #klarna-sdk-button #klarna-sdk-button__text--center #badge{margin:0}
      }
      #klarna-sdk-button.theme-outlined #klarna-sdk-button__inner-container{color:#0e0e0f;background-color:#fff;border:1px solid #0e0e0f}
      #klarna-sdk-button.theme-outlined #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{fill:#0e0e0f}
      #klarna-sdk-button.theme-outlined:hover #klarna-sdk-button__inner-container{background-color:#f1f1f1;color:#333536}
      #klarna-sdk-button.theme-outlined:hover #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{fill:#333536}
      #klarna-sdk-button.theme-outlined:focus #klarna-sdk-button__outline{inset:-5px}
      #klarna-sdk-button.theme-outlined:focus #klarna-sdk-button__outline #klarna-sdk-button__text #logo svg{fill:#0d0e0f}
      #klarna-sdk-button.theme-outlined:active #klarna-sdk-button__inner-container{background-color:#e2e2e2;color:#0d0e0f}
      #klarna-sdk-button.theme-light #klarna-sdk-button__inner-container{color:#0e0e0f;background-color:#fff}
      #klarna-sdk-button.theme-light #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{fill:#0e0e0f}
      #klarna-sdk-button.theme-light:hover #klarna-sdk-button__inner-container{background-color:#f1f1f1;color:#333536}
      #klarna-sdk-button.theme-light:hover #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{fill:#333536}
      #klarna-sdk-button.theme-light:focus #klarna-sdk-button__outline{inset:-5px}
      #klarna-sdk-button.theme-light:focus #klarna-sdk-button__outline #klarna-sdk-button__text #logo svg{fill:#0d0e0f}
      #klarna-sdk-button.theme-light:active #klarna-sign-in__inner-container{background-color:#e2e2e2;color:#0d0e0f}
      #klarna-sdk-button.theme-dark #klarna-sdk-button__inner-container{color:#fff;background-color:#0e0e0f;border:none}
      #klarna-sdk-button.theme-dark #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{fill:#fff}
      #klarna-sdk-button.theme-dark:hover #klarna-sdk-button__inner-container{background-color:#333536;color:#f1f1f1}
      #klarna-sdk-button.theme-dark:hover #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{fill:#f1f1f1}
      #klarna-sdk-button.theme-dark:active #klarna-sdk-button__inner-container{background-color:#0d0e0f;color:#e2e2e2}
      #klarna-sdk-button.theme-dark:active #klarna-sdk-button__inner-container #klarna-sdk-button__text #logo svg{fill:#e2e2e2}
      #klarna-sdk-button.shape-rect #klarna-sdk-button__inner-container{border-radius:0}
      #klarna-sdk-button.shape-rect:focus #klarna-sdk-button__outline{border-radius:0}
      #klarna-sdk-button.shape-pill #klarna-sdk-button__inner-container{border-radius:60px}
      #klarna-sdk-button.shape-pill:focus #klarna-sdk-button__outline{border-radius:60px}
      #klarna-sdk-button.copy-default-en{min-width:165px}
      #klarna-sdk-button__spinner{
        width:24px;
        height:24px;
        border:2px solid;
        border-bottom-color:rgba(0,0,0,0);
        border-radius:50%;
        display:inline-block;
        box-sizing:border-box;
        animation:rotation 1s linear infinite;
        position:absolute;top:calc(50% - 12px);
        right:calc(50% - 12px);
        pointer-events:none
      }

      .theme-outlined #klarna-sdk-button__spinner{
        border-color:#0e0e0f;
        border-bottom-color:#fff
      }

      .theme-dark #klarna-sdk-button__spinner{
        border-color:#fff;
        border-bottom-color:#0e0e0f
      }

      @keyframes rotation{
        0%{transform:rotate(0deg)}
        100%{transform:rotate(360deg)}
      }
    </style>

    <script>
      function handleKlarnaLogin() {
        window.open("{{ url('/login/klarna') }}");
        // use window.location.href = "{{ url('/login/klarna') }}"; if you want to redirect the user to the login page
      }
    </script>
</head>
<body>
    <div class="klarna-sdk-button-container">
      <button id="klarna-sdk-button" class="theme-dark shape-default" onclick="handleKlarnaLogin()">
        <div id="klarna-sdk-button__outline"></div>
        <div id="klarna-sdk-button__inner-container">
          <span id="klarna-sdk-button__text" class="">
            <span id="klarna-sdk-button__text--center">
              <span id="logo" class="hideLogo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_13551_452856)">
                    <path d="M24 0H0V24H24V0Z" fill="#FFA8CD"></path>
                    <path d="M17.7208 4.33496H14.3928C14.3928 7.07246 12.7179 9.52527 10.1729 11.2773L9.17237 11.9781V4.33496H5.71387V19.665H9.17237V12.0657L14.893 19.665H19.1129L13.6097 12.3942C16.1111 10.5765 17.7425 7.75137 17.7208 4.33496Z" fill="#0B051D"></path>
                  </g>
                  <defs>
                    <clipPath id="clip0_13551_452856">
                      <rect width="24" height="24" rx="8.34" fill="white"></rect>
                    </clipPath>
                  </defs>
                </svg>
              </span>
              <span id="copy">Continue with</span>
              <span id="badge">
                <svg width="64" height="28" viewBox="0 0 64 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.5 14C0.5 8.38215 0.5 5.57323 1.84824 3.55544C2.43191 2.68192 3.18192 1.93191 4.05544 1.34824C6.07323 0 8.88215 0 14.5 0H50.5C56.1178 0 58.9268 0 60.9446 1.34824C61.8181 1.93191 62.5681 2.68192 63.1518 3.55544C64.5 5.57323 64.5 8.38215 64.5 14C64.5 19.6178 64.5 22.4268 63.1518 24.4446C62.5681 25.3181 61.8181 26.0681 60.9446 26.6518C58.9268 28 56.1178 28 50.5 28H14.5C8.88215 28 6.07323 28 4.05544 26.6518C3.18192 26.0681 2.43191 25.3181 1.84824 24.4446C0.5 22.4268 0.5 19.6178 0.5 14Z" fill="#FFA8CD"></path>
                  <path d="M52.3359 18.0391C53.4609 18.0391 54.3438 17.1016 54.3438 15.9688C54.3438 14.8359 53.4609 13.9062 52.3359 13.9062C51.2031 13.9062 50.3281 14.8359 50.3281 15.9688C50.3281 17.1016 51.2031 18.0391 52.3359 18.0391ZM8.32812 20V8.34375H10.9688V14.1562L11.7266 13.625C13.6719 12.2891 14.9453 10.4219 14.9453 8.34375H17.4844C17.5 10.9453 16.2578 13.0938 14.3516 14.4766L18.5469 20H15.3281L10.9688 14.2266V20H8.32812ZM19.3125 20V8.34375H21.7969V20H19.3125ZM22.7734 15.9688C22.7734 13.5547 24.3984 11.7266 26.7031 11.7266C27.6719 11.7266 28.8984 12.0938 29.5781 13.5234L29.6406 13.4922C29.3438 12.7109 29.3438 12.2422 29.3438 12.125V11.9375H31.7656V20H29.3438V19.8203C29.3438 19.7031 29.3438 19.2344 29.6406 18.4531L29.5781 18.4219C28.8984 19.8516 27.6719 20.2188 26.7031 20.2188C24.3984 20.2188 22.7734 18.3828 22.7734 15.9688ZM25.2656 15.9688C25.2656 17.1016 26.1406 18.0391 27.2734 18.0391C28.3984 18.0391 29.2812 17.1016 29.2812 15.9688C29.2812 14.8359 28.3984 13.9062 27.2734 13.9062C26.1406 13.9062 25.2656 14.8359 25.2656 15.9688ZM32.9922 20V11.9375H35.4141V12.125C35.4141 12.2422 35.4141 12.7109 35.1172 13.4922L35.1797 13.5234C35.7266 12.125 36.7109 11.7109 37.8047 11.9375V14.4062C37.5547 14.3359 37.3359 14.3047 37.0703 14.3047C36.0938 14.3047 35.5 14.9922 35.5 16.125L35.4844 20H32.9922ZM38.7812 20V11.9375H41.2031V12.125C41.2031 12.2422 41.2031 12.7109 40.9062 13.4922L40.9688 13.5234C41.6719 12.1094 42.5312 11.7266 43.625 11.7266C45.5859 11.7266 47.0078 13.0391 47.0078 14.875V20H44.5234V15.7422C44.5234 14.5391 44.0078 13.9375 42.9609 13.9375C41.9141 13.9375 41.2734 14.6406 41.2734 15.7578V20H38.7812ZM47.8359 15.9688C47.8359 13.5547 49.4609 11.7266 51.7734 11.7266C52.7344 11.7266 53.9609 12.0938 54.6406 13.5234L54.7031 13.4922C54.4062 12.7109 54.4062 12.2422 54.4062 12.125V11.9375H56.8281V20H54.4062V19.8203C54.4062 19.7031 54.4062 19.2344 54.7031 18.4531L54.6406 18.4219C53.9609 19.8516 52.7344 20.2188 51.7734 20.2188C49.4609 20.2188 47.8359 18.3828 47.8359 15.9688Z" fill="#0B051D"></path>
                </svg>
              </span>
            </span>
          </span>
        </div>
      </button>
    </div>
</body>
</html>
