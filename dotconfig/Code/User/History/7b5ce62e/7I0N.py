class Partitioner:
    def __init__(self, kwargs):
        self.__filename = kwargs['filename']
        self.__chrom = kwargs['chrom']
        self.__pop_no = kwargs['pop_ord']
        self.__nodes = kwargs['nodes']
        self.__raw_data = kwargs['raw_data']
        self.__filepath = f'./{self.__filename}/final_population/{self.__pop_no}_mdg.dot'

    def __write_graph_header(filepath):
        with open(filepath, 'w') as f:
            f.write('digraph G {\n')
            f.write('size = "20,20";\n')
