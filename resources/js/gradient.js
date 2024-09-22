// Create a <style> template that will be replaced with variables
let styleTemplate = `
        body {
          background-color: $BACKGROUND-COLOR;
          background-image: $BACKGROUND-IMAGE;
        }

        $ANIMATED-GRADIENTS-CSS
      `;

// Background radial gradients (order matters = first is behind others etc.)
let backgroundGradients = [{
    pos: {x: 65, y: 58}, dim: {w: 20, h: 20}, col: {h: 262, s: 100, l: 69}, duration: 57, delay: -30,
}, {
    pos: {x: 100, y: 35}, col: {h: 180, s: 77, l: 34}, duration: 43, delay: -10,
}, {
    pos: {x: 20, y: 80}, col: {h: 262, s: 100, l: 69}, scale: {min: 0.8, max: 1.6}, duration: 17, delay: -7,
}, {
    pos: {x: 105, y: 105}, col: {h: 180, s: 80, l: 65}, duration: 35, scale: {min: 0.9, max: 1.9}, delay: -17,
}];

// CSS animations using existing gradients + other points of interest
let animatedGradients = [{
    pos: {x: 40, y: 50}, col: {h: 262, s: 100, l: 69}, scale: {min: 0.5}, duration: 35, delay: -7,
}, {
    pos: {x: 0, y: 0},
    col: {h: 180, s: 77, l: 50},
    scale: {min: 1, max: 2},
    opacity: {min: 0, max: 0.5},
    duration: 32,
    delay: -9,
}, {
    pos: {x: 80, y: -10}, col: {h: 180, s: 80, l: 70}, duration: 19, scale: {min: 0.3, max: 0.9}, delay: -5,
}, {
    pos: {x: 70, y: 40}, col: {h: 262, s: 100, l: 60}, duration: 29, delay: -9,
}, {
    pos: {x: 80, y: 6},
    col: {h: 180, s: 77, l: 34},
    duration: 37,
    scale: {max: 2},
    opacity: {min: 0, max: 0.5},
    delay: -8,
}, {
    pos: {x: 75, y: 100}, col: {h: 180, s: 77, l: 55, a: 0.5}, duration: 42, delay: -13,
}].concat(backgroundGradients, [{
    pos: {x: 60, y: 100}, col: {h: 262, s: 64, l: 24, a: 0.3}, duration: 22, delay: -8,
}, {
    pos: {x: 5, y: 50}, col: {h: 262, s: 100, l: 40, a: 0.4}, duration: 26, delay: -9,
}]);

// Transform gradients into CSS
let backgroundGradientsCss = backgroundGradients.filter(g => false).map(g => {
    let position = `${g.pos.x}% ${g.pos.y}%`;
    let color = `hsla(${g.col.h}, ${g.col.s}%, ${g.col.l}%, ${g.col.a || 1}) ${g.at || 0}%`;
    let fade = `transparent ${g.fade || 50}%)`;

    return `radial-gradient(circle at ${position}, ${color}, ${fade}`;
});

// Transform elements animations into CSS
let animatedGradientsCss = animatedGradients.filter(g => true).map((e, index) => {
    let w = e.dim?.w || 50;
    let h = e.dim?.h || 50;
    let x = e.pos.x || 0;
    let y = e.pos.y || 0;
    let cx = x - w / 2;
    let cy = y - h / 2;

    let minScale = e.scale?.min || 0.5;
    let maxScale = e.scale?.max || 1.5;
    let minOpacity = e.opacity?.min || 0.5;
    let maxOpacity = e.opacity?.max || 1;

    return `
          #mesh-gradient .element.e_${index} {
            top: ${cy}%;
            left: ${cx}%;
            right: 0%;
            width: ${w}%;
            height: ${h}%;
            background: hsla(${e.col.h}, ${e.col.s}%, ${e.col.l}%, ${e.col.a || 1});
            animation: e_${index} ${e.duration * 0.8 || 10}s ${e.easing || "ease-in-out"} infinite;
            animation-delay: ${e.delay || 0}s;
          }

          @keyframes e_${index} {
            0% {
              opacity: ${maxOpacity};
              transform: scale(${minScale});
            }

            50% {
              opacity: ${minOpacity};
              transform: scale(${maxScale});
            }

            100% {
              opacity: ${maxOpacity};
              transform: scale(${minScale});
            }
          }
        `;
});

// Add elements to DOM for animations
let $mesh = document.getElementById("mesh-gradient");
animatedGradients.forEach((g, index) => {
    let $element = document.createElement("div");
    $element.classList.add("element", `e_${index}`);
    $mesh.appendChild($element);
    console.log(`e_${index}`, g)
});

// Replace vars in <style>
let styleHtml = styleTemplate;
styleHtml = styleHtml.replaceAll("$BACKGROUND-COLOR", "hsl(262, 64%, 24%)");
styleHtml = styleHtml.replaceAll("$BACKGROUND-IMAGE", backgroundGradientsCss.join(", "));
styleHtml = styleHtml.replaceAll("$ANIMATED-GRADIENTS-CSS", animatedGradientsCss.join("\n\n"));

// Add <style> to document
let $style = document.createElement("style");
$style.appendChild(document.createTextNode(styleHtml));
document.head.appendChild($style);
