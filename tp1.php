<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #title {
        text-align: center;
    }
    #graphContainer {
        text-align: center;
    }
    #graph {
        max-width: 1000px;
        margin: auto;

    }
  </style>
</head>

<body>
    <div id="graph">
        <h1 id="title">Ventes 2022</h1>

        <div id="graphContainer" style="margin:auto;"></div>
    </div>

    

</body>
<script defer>
  let mois = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
  let ventes = [6500, 5550, 4200, 4525, 2500, 1500, 500, 1000, 1750, 2300, 3700, 3500];

  const svgns = "http://www.w3.org/2000/svg";
      let viewPortMaxUnitX = 500;
      let viewPortMaxUnitY = 500;
      let viewport = null;
      init_UI();

      function init_UI() {
        insertViewPort("graphContainer");
        //demoShapes();
        DiagrammeBase();
        SetDiagrammeMonth();
        SetLightHorizontalBars();
        SetColumnValue(ventes);
      }

      function insertViewPort(containerId) {
        viewport = document.createElementNS(svgns, "svg");
        viewport.setAttribute("id", "viewport");
        viewport.setAttribute("viewBox", "-30 0 " + viewPortMaxUnitX + " " + viewPortMaxUnitY);
        document.getElementById(containerId).appendChild(viewport);
      }
      // Fonction qui affiche les 12 mois sur le diagramme
      function SetDiagrammeMonth()
      {
        for(let i=0; i< mois.length; i++)
        {
          viewport.appendChild(text( (i * 30) + 55,   190, mois[i], 45, 0.5, 'black'))
        }
      }
      // Fonction qui reçoit un tableau de ventes sur 12 mois et les affichent dans le diagramme
      function SetColumnValue(ventesTab)
      {
        for(let i=0; i< ventesTab.length; i++)
        {
          viewport.appendChild(rect((i * 30) + 55, 180 - (ventesTab[i] / 50), 20, (ventesTab[i] / 50), 'hsl('+(ventesTab[i] / 62.5)+', 100%, 50%)', 'black', 1)),
          viewport.appendChild(text((i * 30) + 58, 188 - (ventesTab[i] / 50), '$'+ventesTab[i], 0, 0.35, 'black'))
        }
      }

      function SetLightHorizontalBars()
      {
        for(let i=40; i< 180; i= i+5)
        {
          viewport.appendChild(line(50, i+5, 410, i+5, 'black', 0.25))
        }
      }

      function DiagrammeBase() {
        // Barres horizontale
        viewport.appendChild(line(50, 180, 410, 180, 'black', 1)),
        viewport.appendChild(line(50, 160, 410, 160, 'black', 1)),
        viewport.appendChild(line(50, 140, 410, 140, 'black', 1)),
        viewport.appendChild(line(50, 120, 410, 120, 'black', 1)),
        viewport.appendChild(line(50, 100, 410, 100, 'black', 1)),
        viewport.appendChild(line(50,  80, 410,  80, 'black', 1)),
        viewport.appendChild(line(50,  60, 410,  60, 'black', 1)),
        viewport.appendChild(line(50,  40, 410,  40, 'black', 1)),
        // Marqueur de prix dans la marge gauche
        viewport.appendChild(text( 20,   40, '$ 7000', 0, 0.5, 'black')),
        viewport.appendChild(text( 20,   60, '$ 6000', 0, 0.5, 'black')),
        viewport.appendChild(text( 20,   80, '$ 5000', 0, 0.5, 'black')),
        viewport.appendChild(text( 20,  100, '$ 4000', 0, 0.5, 'black')),
        viewport.appendChild(text( 20,  120, '$ 3000', 0, 0.5, 'black')),
        viewport.appendChild(text( 20,  140, '$ 2000', 0, 0.5, 'black')),
        viewport.appendChild(text( 20,  160, '$ 1000', 0, 0.5, 'black')),
        viewport.appendChild(text( 20,  180, '$    0', 0, 0.5, 'black'))
      }

      function demoShapes() {
        viewport.appendChild(line(20, 20, 400, 200, 'green', 15))
        viewport.appendChild(line(20, 20, 400, 150, 'red', 15))
        viewport.appendChild(line(20, 20, 400, 100, 'blue', 15))
        viewport.appendChild(line(20, 20, 400, 50, 'orange', 15))
        viewport.appendChild(rect(500, 20, 300, 200, 'orange', 'yellow', 15))
        viewport.appendChild(rect(500, 300, 300, 200, 'magenta', 'cyan', 15))
        let gray;
        for (let angle = 360; angle >= 0; angle -= 15) {
          gray = angle / 360 * 255;
          viewport.appendChild(text(220, 400, 'Bonjour', angle, 4, `rgb(${gray}, ${gray}, ${gray})`))
        }
      }

      function line(x1, y1, x2, y2, stroke = "black", strokeWidth = 1) {
        let line = document.createElementNS(svgns, "line");
        line.setAttribute("x1", x1);
        line.setAttribute("y1", y1);
        line.setAttribute("x2", x2);
        line.setAttribute("y2", y2);
        line.setAttribute("stroke", stroke);
        line.setAttribute("stroke-width", strokeWidth);
        return line;
      }

      function rect(x, y, width, height, fill = "white", stroke = "black", strokeWidth = 1) {
        let rect = document.createElementNS(svgns, "rect");
        rect.setAttribute("x", x);
        rect.setAttribute("y", y);
        rect.setAttribute("width", width);
        rect.setAttribute("height", height);
        rect.setAttribute("fill", fill);
        rect.setAttribute("stroke", stroke);
        rect.setAttribute("stroke-width", strokeWidth);
        return rect;
      }

      function text(x, y, content, angle = 0, size = "1", fill = "black") {
        let text = document.createElementNS(svgns, "text");
        text.setAttribute("x", x);
        text.setAttribute("y", y);
        text.setAttribute("transform", `rotate(${angle},${x},${y})`);
        text.setAttribute("font-size", size + "em");
        text.setAttribute("fill", fill);
        text.innerHTML = content;
        return text;
      }
</script>

</html>