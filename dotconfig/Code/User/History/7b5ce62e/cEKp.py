class Partitioner:
    def __init__(self, kwargs):
        filename = kwargs['filename']
    im_type = kwargs['type']
    intx = kwargs['intx']
    it_no = kwargs['it_no']
    chrom = kwargs['chrom']
    pop_no = kwargs['pop_ord']
    nodes = kwargs['nodes']
    raw_data = kwargs['raw_data']
    filepath = f'./{filename}/{im_type}/{intx}/{it_no}/final_population/{pop_no}_mdg.dot'
        pass
