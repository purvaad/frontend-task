const slider = document.querySelector('input[type="range"]');
const checkbox = document.querySelector('input[type="checkbox"]');
const priceEl = document.querySelector(".amt-price");
const viewsEl = document.querySelector(".container-pageviews");

const monthlyPrices = [8, 12, 16, 24, 36];
const viewsArr = ["10K pageviews", "50K pageviews", "100K pageviews", "500k pageviews", "1000k pageviews"];

slider.addEventListener("input", calculatePrice);
checkbox.addEventListener("change", calculatePrice);

function calculatePrice() {
    const sliderValue = +slider.value;
    const isYearlyBilling = checkbox.checked;

    //change background color for slider
    slider.style.backgroundSize = `${(sliderValue * 25)}% 100%`;

    //update views
    viewsEl.textContent = viewsArr[sliderValue];

    //calculate price based on years
    const price = isYearlyBilling ? calculateDiscountedPrice(monthlyPrices[sliderValue]) : monthlyPrices[sliderValue];
    // priceEl.textContent = `$${price}.00`;
    priceEl.textContent = isYearlyBilling ? `$${price}` : `$${price}.00`;

}

function calculateDiscountedPrice(monthlyPrice) {
    // const yearlyDiscount = 0.25;
    return (monthlyPrice * 0.75).toFixed(2);
}