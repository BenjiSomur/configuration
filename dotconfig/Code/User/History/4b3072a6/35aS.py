from decoder import decode
from turbomq import TurboMQ


class Fitness:
    def __init__(self, ref, theta, cachesize):
        self.cachesize = cachesize
        self.turbo_mq = TurboMQ(ref, cachesize)
        self.ref = tuple(map(tuple, ref))
        self.lenref = len(ref)
        self.theta = theta

    def __call__(self, _indiv):
        if self.turbo_mq.cache.cache_info().currsize >= self.cachesize:
            self.turbo_mq.cache.cache_clear()
        _chrom = decode(_indiv, self.lenref)
        chrom_tuple = tuple(map(tuple, _chrom))
        tmq = self.turbo_mq(chrom_tuple)
        nc = len(_chrom) / self.lenref
        _deltaclus = (max(_indiv[1]) - min(_indiv[1])) / self.lenref
        return [(tmq * self.theta) + (((1-self.theta)/2) * (nc + (1-_deltaclus))), tmq]
