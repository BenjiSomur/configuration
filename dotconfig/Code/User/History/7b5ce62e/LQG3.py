class Partitioner:
    def __init__(self, kwargs):
        self.__filename = kwargs['filename']
        self.__im_type = kwargs['type']
        self.__intx = kwargs['intx']
        self.__it_no = kwargs['it_no']
        self.__chrom = kwargs['chrom']
        self.__pop_no = kwargs['pop_ord']
        self.__nodes = kwargs['nodes']
        raw_data = kwargs['raw_data']
        filepath = f'./{filename}/{im_type}/{intx}/{it_no}/final_population/{pop_no}_mdg.dot'
