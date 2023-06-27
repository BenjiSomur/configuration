from decoder import decode


def write_graph_header(filepath):
    with open(filepath, 'w') as f:
        f.write('digraph G {\n')
        f.write('size = "20,20";\n')


def add_subgraph(filepath, clus, clus_no, nodes):
    _name = nodes[clus[0]-1]
    with open(filepath, 'a') as f:
        f.write('subgraph cluster{} {{'.format(clus_no))
        f.write('\nlabel = "CL:{}";\n'.format(_name))
        f.write('color = black;\n')
        f.write('style = bold;\n')
        for mod in clus:
            aux = nodes[mod - 1]
            f.write(
                '"{}"[label="{}",shape=ellipse,color=lightblue,fontcolor=black,style=filled];\n'.format(aux, aux))
        f.write('}\n')


def write_relations(filepath, raw_data):
    with open(filepath, 'a') as f:
        for link in raw_data:
            aux = link.split()
            f.write(
                '"{}" -> "{}"[color=blue,font=6];\n'.format(aux[0], aux[1]))
        f.write('}')


def create_graph(kwargs):
    filename = kwargs['filename']
    chrom = kwargs['chrom']
    pop_no = kwargs['pop_ord']
    nodes = kwargs['nodes']
    raw_data = kwargs['raw_data']
    filepath = f'./{filename}/final_population/{pop_no}_mdg.dot'
    write_graph_header(filepath)
    graph = decode(chrom, len(nodes))
    for idx, clus in enumerate(graph):
        add_subgraph(filepath, clus, idx, nodes)
    write_relations(filepath, raw_data)
