const covermain = document.getElementById('cover');
const coverbtn = document.getElementById('cover_btn');

const cover = (n) =>{
    if(n == 0){
        coverbtn.classList.add("cover_btn_open");
        coverbtn.classList.remove("cover_btn_close");

        covermain.classList.add("cover_open");
        covermain.classList.remove("cover_close");
        covermain.innerHTML = `
        <div class="cover_main">
            <div class="cover_list">
                <p>
                    1. <a>シフト提出</a>
                </p>
                <p>
                    2. <a>面談予約</a>
                </p>
                <p>
                    3. <a>作品添削依頼</a>
                </p>
                <p>
                    4. <a>応募書類添削依頼</a>
                <p>
            </div>
            <div class="cover_flex">
                <img src="/assets/icon/Instagram.png" class="icon">
                <img src="/assets/icon/X.png" class="icon">
                <p>ブログへ</p>
                <p>公式サイトへ</p>
            </div>
            <a href="php/logout.php" class="logout red_back red_text ud_600">ログアウト</a>
        </div>
        `;
        coverbtn.innerHTML = `
                    <a class="cover_btn" onclick="cover(1)">
                        <div class="cover_btn_line cover_btn_line1"></div>
                        <div class="cover_btn_line cover_btn_line2"></div>
                    </a>
        `;
    }else{
        coverbtn.classList.add("cover_btn_close");
        coverbtn.classList.remove("cover_btn_open");

        covermain.classList.add("cover_close");
        covermain.classList.remove("cover_open");
        covermain.innerHTML = ``;
        coverbtn.innerHTML = `
                    <a class="cover_btn" onclick="cover(0)">
                        <div class="cover_btn_line cover_btn_line1"></div>
                        <div class="cover_btn_line cover_btn_line2"></div>
                    </a>
        `;
    }
}