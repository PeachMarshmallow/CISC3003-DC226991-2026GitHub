document.addEventListener("DOMContentLoaded", function () {
    const img = document.querySelector("#imgManipulated img");

    // 滑块与显示数值的对应关系
    const sliders = {
        sliderOpacity: "numOpacity",
        sliderSaturation: "numSaturation",
        sliderBrightness: "numBrightness",
        sliderHue: "numHue",
        sliderGray: "numGray",
        sliderBlur: "numBlur"
    };

    // 更新滤镜函数
    function updateFilters() {
        const opacity = document.getElementById("sliderOpacity").value;
        const saturation = document.getElementById("sliderSaturation").value;
        const brightness = document.getElementById("sliderBrightness").value;
        const hue = document.getElementById("sliderHue").value;
        const gray = document.getElementById("sliderGray").value;
        const blur = document.getElementById("sliderBlur").value;

        // 设置滤镜
        img.style.opacity = opacity / 100;
        img.style.filter = `
            saturate(${saturation}%)
            brightness(${brightness}%)
            hue-rotate(${hue}deg)
            grayscale(${gray}%)
            blur(${blur}px)
        `;
    }

    // 给每个滑块绑定事件
    for (let sliderId in sliders) {
        const slider = document.getElementById(sliderId);
        const output = document.getElementById(sliders[sliderId]);

        slider.addEventListener("input", function () {
            output.textContent = slider.value;
            updateFilters();
        });
    }

    // 缩略图点击切换大图
    document.querySelectorAll("#thumbBox img").forEach(thumb => {
        thumb.addEventListener("click", function () {
            img.src = this.src.replace("small", "medium");
            img.alt = this.alt;
            img.title = this.title;

            // 更新图片下方的标题和作者信息
            const figcaption = document.querySelector("#imgManipulated figcaption");
            figcaption.innerHTML = `<em>${this.alt}</em> <br> ${this.title}`;
        });
    });

    // 重置按钮
    document.getElementById("resetFilters").addEventListener("click", function (e) {
        e.preventDefault();
        document.getElementById("sliderOpacity").value = 100;
        document.getElementById("sliderSaturation").value = 100;
        document.getElementById("sliderBrightness").value = 100;
        document.getElementById("sliderHue").value = 0;
        document.getElementById("sliderGray").value = 0;
        document.getElementById("sliderBlur").value = 0;

        // 更新数值显示
        for (let sliderId in sliders) {
            const slider = document.getElementById(sliderId);
            const output = document.getElementById(sliders[sliderId]);
            output.textContent = slider.value;
        }

        updateFilters();
    });

    // 初始化
    updateFilters();
});
