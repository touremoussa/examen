@extends('default')

@section('content')
    <div> 
        <h3>Formations Par Type</h3>
    </div>

    <div id="formations-par-type"></div>
<div>
        <table class="table">
            <tr>
                <th>Nom</th>
                <th>Total</th>
            </tr>
            @if($formations->count() != 0)
            @foreach($formations as $formation)
                <tr>
                    <td>{{$formation->libelle}}</td>
                    <td>{{$formation->total}}</td>
                </tr>
            @endforeach
            @else
            <tr>
                <td colspan="2"><h2>Desolee Aucune donnée a representer</h2></td>
            </tr>
            @endif
        </table>
</div>

@section('scripts')
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
        // Récupération des données
        var data = {!! json_encode($formations) !!};

        // Définition des dimensions du graphique
        var width = 500,
            height = 500,
            radius = Math.min(width, height) / 2;

        // Création du graphique
        var svg = d3.select('#formations-par-type')
            .append('svg')
            .attr('width', width)
            .attr('height', height)
            .append('g')
            .attr('transform', 'translate(' + width / 2 + ',' + height / 2 + ')');

        // Création de la fonction pie
        var pie = d3.pie()
            .value(function(d) { return d.total; })
            .sort(null);

        // Définition des couleurs
        var color = d3.scaleOrdinal(d3.schemeCategory10);

        // Création de l'arc
        var arc = d3.arc()
            .innerRadius(radius - 100)
            .outerRadius(radius - 50);

        // Création des éléments du graphique
        var g = svg.selectAll('.arc')
            .data(pie(data))
            .enter()
            .append('g')
            .attr('class', 'arc');

        // Création des arcs
        g.append('path')
            .attr('d', arc)
            .style('fill', function(d) { return color(d.data.libelle); });

        // Ajout des labels
        g.append('text')
            .attr('transform', function(d) { return 'translate(' + arc.centroid(d) + ')'; })
            .attr('dy', '.35em')
            .text(function(d) { return d.data.libelle + ' (' + d.data.total + ')'; });

</script>

@endsection

@endsection

