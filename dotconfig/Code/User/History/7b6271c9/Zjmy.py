from matplotlib import pyplot as plt
from city import City
import xml.etree.ElementTree as ET
import networkx as nx
import random as rnd
import sys
sys.path.append('.')


def switch(case):
    switcher = {
        'start': 'green',
        'path': 'royalblue'
    }
    return switcher.get(case, 'silver')


def initialize_cities():
    cities = []
    tree = ET.parse('./xml/cities.xml')
    root = tree.getroot()
    for indx, stadt in enumerate(root.findall('city')):
        city_name = stadt.get('Name')
        coords = stadt.get('Coords')
        city_coords = [int(elem) for elem in coords.split(',')]
        cities.append(City(indx, city_name, tuple(city_coords)))
    return cities


def create_graph(path, cities):
    G = nx.DiGraph()
    for indx, city in enumerate(cities):
        G.add_node(indx, pos=city.get_coords(), label=city.get_name())
        G.nodes[indx]['color'] = switch(case='start') if city.is_start() else (
            switch(case='path') if city.get_id() in path
            else switch(case='default'))
    for indx, city in enumerate(path):
        try:
            G.add_edge(city, path[indx+1], color=switch(case='path'))
        except IndexError:
            pass

    for edge in G.edges():
        G.edges[edge]['width'] = 2

    return G


def print_path(G, cities, path):
    img = plt.imread("./Figures/mexico.jpg")
    pos = nx.get_node_attributes(G, 'pos')
    lbls = nx.get_node_attributes(G, 'label')
    lbls = {i: lbls[i] for i in G.nodes() if i in path}
    coords = {i: pos[i] for i in G.nodes() if i in path}
    colors = [nx.get_node_attributes(G, 'color')[i]
              for i in range(len(cities))]
    widths = [nx.get_edge_attributes(G, 'width')[i] for i in G.edges()]
    edge_colors = [nx.get_edge_attributes(G, 'color')[i] for i in G.edges()]
    nx.draw(G, pos, with_labels=False, node_size=40, node_color=colors,
            edge_color=edge_colors, width=widths)
    nx.draw_networkx_labels(G, pos, labels=lbls, font_color='black',
                            font_size=10, verticalalignment='bottom')
    nx.draw_networkx_labels(
        G, pos, labels=coords, font_size=10, font_color='black', verticalalignment='top')
    plt.imshow(img)
    plt.show()


if __name__ == "__main__":
    cities = initialize_cities()
    path = []
    while len(path) < 15:
        aux = rnd.randint(0, (len(cities) - 1))
        if aux not in path:
            path.append(aux)
    path.append(path[0])
    print(path)
    G = create_graph([], cities)
    print_path(G, cities, path)
