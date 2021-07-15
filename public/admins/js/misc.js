(function ($) {
    "use strict";
    $(function () {
        function imageObserver() {
            const images = document.querySelectorAll("img[observe='true']");

            const observer = new IntersectionObserver(function (
                entries,
                observer
            ) {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        let img = entry.target;
                        if (img.hasAttribute("observe-src")) {
                            img.setAttribute(
                                "src",
                                img.getAttribute("observe-src")
                            );
                            observer.unobserve(entry.target);
                        }
                    }
                });
            });

            images.forEach((img) => {
                observer.observe(img);
            });
        }

        Livewire.on("observeImage", () => {
            imageObserver();
        });

        imageObserver();

        var sidebar = $(".mdc-drawer-menu");
        var body = $("body");

        const sidebarDrawer = document.querySelector(".mdc-drawer");
        const preOpen = localStorage.getItem("sidebarOpen");

        if (preOpen === "false") {
            sidebarDrawer.classList.remove("mdc-drawer--open");
        }

        document
            .querySelector(".mdc-drawer__content")
            .querySelectorAll("a")
            .forEach((el) => {
                el.getAttribute("href") == window.location.href &&
                    el.classList.add("active");
            });

        if ($(".mdc-drawer").length) {
            var drawer = mdc.drawer.MDCDrawer.attachTo(
                document.querySelector(".mdc-drawer")
            );

            // toggler icon click function
            document
                .querySelector(".sidebar-toggler")
                .addEventListener("click", function () {
                    let open = true;

                    sidebarDrawer.classList.contains("mdc-drawer--open") &&
                        (open = false);

                    drawer.open = !drawer.open;
                    localStorage.setItem("sidebarOpen", open);
                });
        }

        // Initially collapsed drawer in below desktop
        if (window.matchMedia("(max-width: 991px)").matches) {
            if (
                document
                    .querySelector(".mdc-drawer.mdc-drawer--dismissible")
                    .classList.contains("mdc-drawer--open")
            ) {
                document
                    .querySelector(".mdc-drawer.mdc-drawer--dismissible")
                    .classList.remove("mdc-drawer--open");
            }
        }

        $(".mdc-drawer-item .mdc-drawer-link", sidebar).each(function () {
            if (
                $(this)[0].classList.contains("active") &&
                $(this).parents(".mdc-expansion-panel").length
            ) {
                const panel = $(this).closest(".mdc-expansion-panel");

                panel.show();
                const panelLink = panel.prev(".mdc-expansion-panel-link");

                panelLink.addClass("expanded");
            }
        });

        // Toggle Sidebar items
        $('[data-toggle="expansionPanel"]').on("click", function () {
            // close other items
            $(".mdc-expansion-panel")
                .not($("#" + $(this).attr("data-target")))
                .hide(300);
            $(".mdc-expansion-panel")
                .not($("#" + $(this).attr("data-target")))
                .prev('[data-toggle="expansionPanel"]')
                .removeClass("expanded");
            // Open toggle menu
            $("#" + $(this).attr("data-target")).slideToggle(300, function () {
                $("#" + $(this).attr("data-target")).toggleClass("expanded");
            });
        });

        $("#filterToggle").on("click", () => {
            $("#filterArea").slideToggle(100);
        });

        // Add expanded class to mdc-drawer-link after expanded
        $(".mdc-drawer-item .mdc-expansion-panel").each(function () {
            $(this)
                .prev('[data-toggle="expansionPanel"]')
                .on("click", function () {
                    $(this).toggleClass("expanded");
                });
        });

        //Applying perfect scrollbar to sidebar
        if (!body.hasClass("rtl")) {
            if ($(".mdc-drawer .mdc-drawer__content").length) {
                const chatsScroll = new PerfectScrollbar(
                    ".mdc-drawer .mdc-drawer__content"
                );
            }
        }
    });
})(jQuery);
