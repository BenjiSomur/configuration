from decoder import decode


def create_graph(kwargs):
    filename = kwargs['filename']
    chrom = kwargs['chrom']
    pop_no = kwargs['pop_ord']
    nodes = kwargs['nodes']
    raw_data = kwargs['raw_data']
    filepath = f'./{filename}/final_population/{pop_no}_mdg.dot'


def write_graph_header(filepath):
    with open(filepath, 'w') as f:
        f.write('digraph G {\n')
        f.write('size = "20,20";\n')
