class Partitioner:
    def __init__(self, kwargs):
        self.__filename = kwargs['filename']
        self.__chrom = kwargs['chrom']
        self.__pop_no = kwargs['pop_ord']
        self.__nodes = kwargs['nodes']
        self.__raw_data = kwargs['raw_data']
        self.__filepath = f'./{self.__filename}/final_population/{self.__pop_no}_mdg.dot'
