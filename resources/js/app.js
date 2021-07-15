require("./bootstrap");
import { MDCTooltip } from "@material/tooltip";

window.addEventListener("livewire:load", () => {
    const tooltips = document.querySelectorAll(".mdc-tooltip");
    tooltips &&
        tooltips.forEach((tooltip) => {
            new MDCTooltip(tooltip);
        });
});
